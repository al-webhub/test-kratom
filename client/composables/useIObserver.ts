//import { ref } from "vue";

// const useIObserver = () => {
//   const observedElement = ref("");
  
//   const elementClass = ref("");

//   const interOptions = (rootPar, thresholdPar) => {
//     return {
//       root: rootPar,
//       threshold: thresholdPar,
//     };
//   };

//   const interCallback = function (entries) {
//     if (entries) {
//       const [entry] = entries;
      
//       if (entry.isIntersecting) {
//         observedElement.value.classList.add(elementClass.value);
//       }
//     }
//   };
  
//   const observer = new IntersectionObserver(interCallback, interOptions);

//   return {
//     observedElement,
//     elementClass,
//     interOptions,
//     interCallback,
//     observer,
//   };                  
// };

// export default useIObserver;


export const useIObserver = () => {
  const items = []
  
  const options = {
    root: null,
    rootMargin: '0px',
    threshold: 1.0
  }

  const callback = (v) => {
    console.log('observ', v)
    if(!v.isIntersecting) {
      v.target.classList.add('not-visible')
    }
  }

  const observer = new IntersectionObserver(callback, options);

  return {
    observer
  };                  
};