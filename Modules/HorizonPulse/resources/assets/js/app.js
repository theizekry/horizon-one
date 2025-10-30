// Basic test to see if JavaScript is working
console.log('JavaScript is loading...')

// Try to find the target element
const targetElement = document.getElementById('horizon-pulse-dashboard')
console.log('Target element found:', targetElement)

if (targetElement) {
  targetElement.innerHTML = '<h1>JavaScript is working!</h1><p>Vue should work too.</p>'
  console.log('Basic JavaScript executed successfully')
} else {
  console.error('Target element not found')
}
