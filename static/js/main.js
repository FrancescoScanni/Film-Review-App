
const logs=document.querySelectorAll(".log").forEach(logsFunction)

function logsFunction(elem,i,arr){
    if(i===0){
        arr[i].addEventListener("click",()=>{
            window.location.href="registra.php"
        })
    }else{
        arr[i].addEventListener("click",()=>{
            window.location.href="signIn.php"
        })
    }
}