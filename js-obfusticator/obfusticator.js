/********************************************
*            This is SimpleScript           *
*   just writed for test mini obfusticator  *
*          Author: Hadi Abedzadeh           *
*********************************************/

var str = 'alert("Encode Me")'; // Output: ")/q"/qe/qM/q /qe/qd/qo/qc/qn/qE/q"/q(/qt/qr/qe/ql/qa";

// Obfustication function

var F = (str.split("").reverse().join("/q"));
var X = ("\"" + str.split("").reverse().join("/q") + "\";");
console.log(X);

// deObfustication function
function _(a) {
    eval(F.replace(/q/g, "").replace(/\/*\//g, "").split("").reverse().join(""));
}
_(X);
