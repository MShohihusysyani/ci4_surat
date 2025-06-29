/// <reference path="../../../../sweetalert2.d.ts"/>

/**
 * @typedef { HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement } Input
 * @typedef { 'input' | 'file' | 'range' | 'select' | 'radio' | 'checkbox' | 'textarea' } InputClass
 */
import privateProps from '../../../privateProps.js'
import { swalClasses } from '../../classes.js'
import * as dom from '../../dom/index.js'
import { error, isPromise, warn } from '../../utils.js'

/** @type {InputClass[]} */
const inputClasses = ['input', 'file', 'range', 'select', 'radio', 'checkbox', 'textarea']

/**
 * @param {SweetAlert} instance
 * @param {SweetAlertOptions} params
 */
export const renderInput = (instance, params) => {
  const popup = dom.getPopup()
  if (!popup) {
    return
  }
  const innerParams = privateProps.innerParams.get(instance)
  const rerender = !innerParams || params.input !== innerParams.input

  inputClasses.forEach((inputClass) => {
    const inputContainer = dom.getDirectChildByClass(popup, swalClasses[inputClass])

    if (!inputContainer) {
      return
    }

    // set attributes
    setAttributes(inputClass, params.inputAttributes)

    // set class
    inputContainer.className = swalClasses[inputClass]

    if (rerender) {
      dom.hide(inputContainer)
    }
  })

  if (params.input) {
    if (rerender) {
      showInput(params)
    }
    // set custom class
    setCustomClass(params)
  }
}

/**
 * @param {SweetAlertOptions} params
 */
const showInput = (params) => {
  if (!params.input) {
    return
  }

  if (!renderInputType[params.input]) {
    error(`Unexpected type of input! Expected ${Object.keys(renderInputType).join(' | ')}, got "${params.input}"`)
    return
  }

  const inputContainer = getInputContainer(params.input)
  if (!inputContainer) {
    return
  }

  const input = renderInputType[params.input](inputContainer, params)
  dom.show(inputContainer)

  // input autofocus
  if (params.inputAutoFocus) {
    setTimeout(() => {
      dom.focusInput(input)
    })
  }
}

/**
 * @param {HTMLInputElement} input
 */
const removeAttributes = (input) => {
  for (let i = 0; i < input.attributes.length; i++) {
    const attrName = input.attributes[i].name
    if (!['id', 'type', 'value', 'style'].includes(attrName)) {
      input.removeAttribute(attrName)
    }
  }
}

/**
 * @param {InputClass} inputClass
 * @param {SweetAlertOptions['inputAttributes']} inputAttributes
 */
const setAttributes = (inputClass, inputAttributes) => {
  const popup = dom.getPopup()
  if (!popup) {
    return
  }

  const input = dom.getInput(popup, inputClass)
  if (!input) {
    return
  }

  removeAttributes(input)

  for (const attr in inputAttributes) {
    input.setAttribute(attr, inputAttributes[attr])
  }
}

/**
 * @param {SweetAlertOptions} params
 */
const setCustomClass = (params) => {
  if (!params.input) {
    return
  }
  const inputContainer = getInputContainer(params.input)
  if (inputContainer) {
    dom.applyCustomClass(inputContainer, params, 'input')
  }
}

/**
 * @param {HTMLInputElement | HTMLTextAreaElement} input
 * @param {SweetAlertOptions} params
 */
const setInputPlaceholder = (input, params) => {
  if (!input.placeholder && params.inputPlaceholder) {
    input.placeholder = params.inputPlaceholder
  }
}

/**
 * @param {Input} input
 * @param {Input} prependTo
 * @param {SweetAlertOptions} params
 */
const setInputLabel = (input, prependTo, params) => {
  if (params.inputLabel) {
    const label = document.createElement('label')
    const labelClass = swalClasses['input-label']
    label.setAttribute('for', input.id)
    label.className = labelClass
    if (typeof params.customClass === 'object') {
      dom.addClass(label, params.customClass.inputLabel)
    }
    label.innerText = params.inputLabel
    prependTo.insertAdjacentElement('beforebegin', label)
  }
}

/**
 * @param {SweetAlertInput} inputType
 * @returns {HTMLElement | undefined}
 */
const getInputContainer = (inputType) => {
  const popup = dom.getPopup()
  if (!popup) {
    return
  }

  return dom.getDirectChildByClass(popup, swalClasses[/** @type {SwalClass} */ (inputType)] || swalClasses.input)
}

/**
 * @param {HTMLInputElement | HTMLOutputElement | HTMLTextAreaElement} input
 * @param {SweetAlertOptions['inputValue']} inputValue
 */
const checkAndSetInputValue = (input, inputValue) => {
  if (['string', 'number'].includes(typeof inputValue)) {
    input.value = `${inputValue}`
  } else if (!isPromise(inputValue)) {
    warn(`Unexpected type of inputValue! Expected "string", "number" or "Promise", got "${typeof inputValue}"`)
  }
}

/** @type {Record<SweetAlertInput, (input: Input | HTMLElement, params: SweetAlertOptions) => Input>} */
const renderInputType = {}

/**
 * @param {HTMLInputElement} input
 * @param {SweetAlertOptions} params
 * @returns {HTMLInputElement}
 */
renderInputType.text =
  renderInputType.email =
  renderInputType.password =
  renderInputType.number =
  renderInputType.tel =
  renderInputType.url =
  renderInputType.search =
  renderInputType.date =
  renderInputType['datetime-local'] =
  renderInputType.time =
  renderInputType.week =
  renderInputType.month =
    /** @type {(input: Input | HTMLElement, params: SweetAlertOptions) => Input} */
    (input, params) => {
      checkAndSetInputValue(input, params.inputValue)
      setInputLabel(input, input, params)
      setInputPlaceholder(input, params)
      input.type = params.input
      return input
    }

/**
 * @param {HTMLInputElement} input
 * @param {SweetAlertOptions} params
 * @returns {HTMLInputElement}
 */
renderInputType.file = (input, params) => {
  setInputLabel(input, input, params)
  setInputPlaceholder(input, params)
  return input
}

/**
 * @param {HTMLInputElement} range
 * @param {SweetAlertOptions} params
 * @returns {HTMLInputElement}
 */
renderInputType.range = (range, params) => {
  const rangeInput = range.querySelector('input')
  const rangeOutput = range.querySelector('output')
  checkAndSetInputValue(rangeInput, params.inputValue)
  rangeInput.type = params.input
  checkAndSetInputValue(rangeOutput, params.inputValue)
  setInputLabel(rangeInput, range, params)
  return range
}

/**
 * @param {HTMLSelectElement} select
 * @param {SweetAlertOptions} params
 * @returns {HTMLSelectElement}
 */
renderInputType.select = (select, params) => {
  select.textContent = ''
  if (params.inputPlaceholder) {
    const placeholder = document.createElement('option')
    dom.setInnerHtml(placeholder, params.inputPlaceholder)
    placeholder.value = ''
    placeholder.disabled = true
    placeholder.selected = true
    select.appendChild(placeholder)
  }
  setInputLabel(select, select, params)
  return select
}

/**
 * @param {HTMLInputElement} radio
 * @returns {HTMLInputElement}
 */
renderInputType.radio = (radio) => {
  radio.textContent = ''
  return radio
}

/**
 * @param {HTMLLabelElement} checkboxContainer
 * @param {SweetAlertOptions} params
 * @returns {HTMLInputElement}
 */
renderInputType.checkbox = (checkboxContainer, params) => {
  const checkbox = dom.getInput(dom.getPopup(), 'checkbox')
  checkbox.value = '1'
  checkbox.checked = Boolean(params.inputValue)
  const label = checkboxContainer.querySelector('span')
  dom.setInnerHtml(label, params.inputPlaceholder)
  return checkbox
}

/**
 * @param {HTMLTextAreaElement} textarea
 * @param {SweetAlertOptions} params
 * @returns {HTMLTextAreaElement}
 */
renderInputType.textarea = (textarea, params) => {
  checkAndSetInputValue(textarea, params.inputValue)
  setInputPlaceholder(textarea, params)
  setInputLabel(textarea, textarea, params)

  /**
   * @param {HTMLElement} el
   * @returns {number}
   */
  const getMargin = (el) =>
    parseInt(window.getComputedStyle(el).marginLeft) + parseInt(window.getComputedStyle(el).marginRight)

  // https://github.com/sweetalert2/sweetalert2/issues/2291
  setTimeout(() => {
    // https://github.com/sweetalert2/sweetalert2/issues/1699
    if ('MutationObserver' in window) {
      const initialPopupWidth = parseInt(window.getComputedStyle(dom.getPopup()).width)
      const textareaResizeHandler = () => {
        // check if texarea is still in document (i.e. popup wasn't closed in the meantime)
        if (!document.body.contains(textarea)) {
          return
        }
        const textareaWidth = textarea.offsetWidth + getMargin(textarea)
        if (textareaWidth > initialPopupWidth) {
          dom.getPopup().style.width = `${textareaWidth}px`
        } else {
          dom.applyNumericalStyle(dom.getPopup(), 'width', params.width)
        }
      }
      new MutationObserver(textareaResizeHandler).observe(textarea, {
        attributes: true,
        attributeFilter: ['style'],
      })
    }
  })

  return textarea
}
