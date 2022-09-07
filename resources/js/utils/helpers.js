/**
 * Formats given number
 * 123456789 => 123,456,789
 * 
 * @param {number} num 
 * @param {string} separator 
 * @returns {string} Comma separated number
 */
export const numberWithCommas = (num, separator = ',') =>
  num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, separator);

/**
 * 
 * @param {String} str 
 * @returns {String} Capitalized string
 */
export const capitalizeFirstLetter = str =>
  str.charAt(0).toUpperCase() + str.slice(1);

export const calculateGainLoss = (amount, currPrice, oldPrice) =>
  amount * currPrice - amount * oldPrice;
