/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/product/main.js":
/*!**************************************!*\
  !*** ./resources/js/product/main.js ***!
  \**************************************/
/***/ (() => {

eval("document.getElementById('inputFile').addEventListener('click', changeIputFile);\ndocument.getElementById('files').addEventListener('change', readFileInput);\n\nfunction changeIputFile(e) {\n  e.currentTarget.childNodes[5].click();\n}\n\nfunction readFileInput(e) {\n  //Text Input\n  document.getElementById('inputFile').childNodes[3].value = e.target.files[0].name;\n  document.getElementById('inputFile').childNodes[3].name = ''; //Input File\n\n  e.currentTarget.parentNode.childNodes[5].name = 'image';\n  console.log(e.target.files);\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcHJvZHVjdC9tYWluLmpzPzRmNGMiXSwibmFtZXMiOlsiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImFkZEV2ZW50TGlzdGVuZXIiLCJjaGFuZ2VJcHV0RmlsZSIsInJlYWRGaWxlSW5wdXQiLCJlIiwiY3VycmVudFRhcmdldCIsImNoaWxkTm9kZXMiLCJjbGljayIsInZhbHVlIiwidGFyZ2V0IiwiZmlsZXMiLCJuYW1lIiwicGFyZW50Tm9kZSIsImNvbnNvbGUiLCJsb2ciXSwibWFwcGluZ3MiOiJBQUFBQSxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsV0FBeEIsRUFBcUNDLGdCQUFyQyxDQUFzRCxPQUF0RCxFQUErREMsY0FBL0Q7QUFDQUgsUUFBUSxDQUFDQyxjQUFULENBQXdCLE9BQXhCLEVBQWlDQyxnQkFBakMsQ0FBa0QsUUFBbEQsRUFBNERFLGFBQTVEOztBQUVBLFNBQVNELGNBQVQsQ0FBd0JFLENBQXhCLEVBQTBCO0FBQ3RCQSxFQUFBQSxDQUFDLENBQUNDLGFBQUYsQ0FBZ0JDLFVBQWhCLENBQTJCLENBQTNCLEVBQThCQyxLQUE5QjtBQUNIOztBQUVELFNBQVNKLGFBQVQsQ0FBdUJDLENBQXZCLEVBQXlCO0FBQ3JCO0FBQ0FMLEVBQUFBLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixXQUF4QixFQUFxQ00sVUFBckMsQ0FBZ0QsQ0FBaEQsRUFBbURFLEtBQW5ELEdBQTJESixDQUFDLENBQUNLLE1BQUYsQ0FBU0MsS0FBVCxDQUFlLENBQWYsRUFBa0JDLElBQTdFO0FBQ0FaLEVBQUFBLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixXQUF4QixFQUFxQ00sVUFBckMsQ0FBZ0QsQ0FBaEQsRUFBbURLLElBQW5ELEdBQTBELEVBQTFELENBSHFCLENBS3JCOztBQUNBUCxFQUFBQSxDQUFDLENBQUNDLGFBQUYsQ0FBZ0JPLFVBQWhCLENBQTJCTixVQUEzQixDQUFzQyxDQUF0QyxFQUF5Q0ssSUFBekMsR0FBZ0QsT0FBaEQ7QUFDQUUsRUFBQUEsT0FBTyxDQUFDQyxHQUFSLENBQVlWLENBQUMsQ0FBQ0ssTUFBRixDQUFTQyxLQUFyQjtBQUNIIiwic291cmNlc0NvbnRlbnQiOlsiZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2lucHV0RmlsZScpLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgY2hhbmdlSXB1dEZpbGUpXG5kb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZmlsZXMnKS5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCByZWFkRmlsZUlucHV0KVxuXG5mdW5jdGlvbiBjaGFuZ2VJcHV0RmlsZShlKXtcbiAgICBlLmN1cnJlbnRUYXJnZXQuY2hpbGROb2Rlc1s1XS5jbGljaygpXG59XG5cbmZ1bmN0aW9uIHJlYWRGaWxlSW5wdXQoZSl7XG4gICAgLy9UZXh0IElucHV0XG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2lucHV0RmlsZScpLmNoaWxkTm9kZXNbM10udmFsdWUgPSBlLnRhcmdldC5maWxlc1swXS5uYW1lXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2lucHV0RmlsZScpLmNoaWxkTm9kZXNbM10ubmFtZSA9ICcnXG5cbiAgICAvL0lucHV0IEZpbGVcbiAgICBlLmN1cnJlbnRUYXJnZXQucGFyZW50Tm9kZS5jaGlsZE5vZGVzWzVdLm5hbWUgPSAnaW1hZ2UnXG4gICAgY29uc29sZS5sb2coZS50YXJnZXQuZmlsZXMpXG59XG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3Byb2R1Y3QvbWFpbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/product/main.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/product/main.js"]();
/******/ 	
/******/ })()
;