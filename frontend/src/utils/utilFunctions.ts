export {mapValues} from "lodash"

// sleep for n miliseconds
export function sleep(ms: number) {
  return new Promise(resolve => setTimeout(resolve, ms))
}

// remove element(s) from array
export function remove(array: any[], pElements: any | any[]) {
  const elements = Array.isArray(pElements) ? pElements : [pElements]
  elements.forEach(x => {
    const index = array.indexOf(x)
    if (index !== -1) array.splice(index, 1)
  })
}

// toggle element(s) in array
export function toggle(array: any[], pElements: any | any[]) {
  const elements = Array.isArray(pElements) ? pElements : [pElements]
  elements.forEach(x => {
    if (array.includes(x)) {
      array.splice(array.indexOf(x), 1)
    } else {
      array.push(x)
    }
  })
}

// download file(s)
export function download(pUrls: string | string[]) {
  const urls = Array.isArray(pUrls) ? pUrls : [pUrls]
  urls.forEach(url => {
    fetch(url)
      .then(x => x.blob())
      .then(blob => {
        const a = document.createElement("a")
        a.href = URL.createObjectURL(blob)
        a.download = url.split("/").slice(-1)[0]
        a.click()
        URL.revokeObjectURL(url)
      })
  })
}

