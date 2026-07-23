const search=document.getElementById("searchUser");
const rows=document.querySelectorAll("#userTable tbody tr");
search.addEventListener("keyup",()=>{
    const value=search.value.toLowerCase();
    rows.forEach(row=>{
        row.style.display=row.innerText.toLowerCase().includes(value)
        ? ""
        :"none";
    });
});