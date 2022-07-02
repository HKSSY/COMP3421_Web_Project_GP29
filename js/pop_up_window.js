const element = document.getElementById("tips");
element.addEventListener("click", function(){
    setTimeout(
        function open(event){
            document.querySelector(".popup").style.display = "block";
        },
        100 
    )
});


document.querySelector("#close").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
});
