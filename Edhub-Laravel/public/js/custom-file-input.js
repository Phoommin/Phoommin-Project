var inputs = document.querySelectorAll(".inputfile");
Array.prototype.forEach.call(inputs, function(input) {
    var label = input.nextElementSibling,
        labelVal = label.innerHTML;

    input.addEventListener("change", function(e) {
        var fileName = "";

        if (fileName) label.querySelector("span").innerHTML = fileName;
        else label.innerHTML = labelVal;
    });

    // Firefox bug fix
    input.addEventListener("focus", function() {
        input.classList.add("has-focus");
    });
    input.addEventListener("blur", function() {
        input.classList.remove("has-focus");
    });
});
