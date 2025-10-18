import {helpers} from '@vuelidate/validators'

// Custom rule to check input value is one of valid allowed list.
export const oneOf = (list) => helpers.withMessage(`Value must be one of: ${list.join(', ')}`, value => list.includes(value))