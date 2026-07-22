const search=document.getElementById("searchUser");
const rows=document.querySelectorAll("#userTable tbody tr");
search.addEventListener("keyup",()=>{
    const value=search.value.toLowerCase();
    rows.forEach(row=>{
        row.style.display=row.innerText.toLowerCase().includes(value)
        ? ""
        : "none";
    });
});

const roleFilter=document.getElementById("roleFilter");
roleFilter.addEventListener("change",()=>{
    rows.forEach(row=>{
        const role=row.cells[3].innerText.toLowerCase();
        row.style.display=
        roleFilter.value=="" ||
        role==roleFilter.value
        ?""
        :
        "none";
    });
});