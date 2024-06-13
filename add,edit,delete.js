//Add Popup animation//

let popup = document.getElementById("popup");

function openAdd(){
    popup.classList.add("open-popup");
    closeEdit();
    closeDelete();
}
function closeAdd(){
    popup.classList.remove("open-popup");
}
//Add Popup animation//

// Draggable Div Element for add inventory
const popup1 = document.querySelector(".popup");
const h2 = popup1.querySelector("h2");
let isDragging = false;
let initialX, initialY;

function onDragStart(e) {
    isDragging = true;
    initialX = e.clientX;
    initialY = e.clientY;
}

function onDrag(e) {
    if (!isDragging) return;

    const deltaX = e.clientX - initialX;
    const deltaY = e.clientY - initialY;
    initialX = e.clientX;
    initialY = e.clientY;

    let getStyle = window.getComputedStyle(popup1);
    let left = parseInt(getStyle.left);
    let top = parseInt(getStyle.top);

    const newLeft = left + deltaX;
    const newTop = top + deltaY;

    popup1.style.left = `${newLeft}px`;
    popup1.style.top = `${newTop}px`;
}

function onDragEnd() {
    isDragging = false;
}

h2.addEventListener("mousedown", onDragStart);
document.addEventListener("mousemove", onDrag);
document.addEventListener("mouseup", onDragEnd);
// Draggable Div Element END



//Edit Popup animation//
let popup2 = document.getElementById("popup2");

function openEdit(){
    popup2.classList.add("open-popup2");
    closeAdd();
    closeDelete();
}
function closeEdit(){
    popup2.classList.remove("open-popup2");
}
//Edit Popup animation//


// Draggable Div Element for edit inventory
const popupedit = document.querySelector(".popup2");
const edit = popupedit.querySelector("h2");
let isDragging1 = false;
let initialx, initialy;

function onDragStart1(e) {
    isDragging1 = true;
    initialx = e.clientX;
    initialy = e.clientY;
}

function onDrag1(e) {
    if (!isDragging1) return;

    const deltaX = e.clientX - initialx;
    const deltaY = e.clientY - initialy;
    initialx = e.clientX;
    initialy = e.clientY;

    let getStyle = window.getComputedStyle(popupedit);
    let left = parseInt(getStyle.left);
    let top = parseInt(getStyle.top);

    const newLeft = left + deltaX;
    const newTop = top + deltaY;

    popupedit.style.left = `${newLeft}px`;
    popupedit.style.top = `${newTop}px`;
}

function onDragEnd1() {
    isDragging1 = false;
}

edit.addEventListener("mousedown", onDragStart1);
document.addEventListener("mousemove", onDrag1);
document.addEventListener("mouseup", onDragEnd1);
// Draggable Div Element edit inventory END




//Delete Popup animation//
let popup3 = document.getElementById("popup3");

function openDelete(){
    popup3.classList.add("open-popup3");
    closeAdd();
    closeEdit();
}
function closeDelete(){
    popup3.classList.remove("open-popup3");
}
//Delete Popup animation//

// Draggable Div Element for edit inventory
const popupdelete = document.querySelector(".popup3");
const Delete = popupdelete.querySelector("h2");
let isDragging2 = false;
let initialx1, initialy1;

function onDragStart2(e) {
    isDragging2 = true;
    initialx1 = e.clientX;
    initialy1 = e.clientY;
}

function onDrag2(e) {
    if (!isDragging2) return;

    const deltaX = e.clientX - initialx1;
    const deltaY = e.clientY - initialy1;
    initialx1 = e.clientX;
    initialy1 = e.clientY;

    let getStyle1 = window.getComputedStyle(popupdelete);
    let left1 = parseInt(getStyle1.left);
    let top1 = parseInt(getStyle1.top);

    const newLeft = left1 + deltaX;
    const newTop = top1 + deltaY;

    popupdelete.style.left = `${newLeft}px`;
    popupdelete.style.top = `${newTop}px`;
}

function onDragEnd2() {
    isDragging2 = false;
}

Delete.addEventListener("mousedown", onDragStart2);
document.addEventListener("mousemove", onDrag2);
document.addEventListener("mouseup", onDragEnd2);
// Draggable Div Element edit inventory END



//CUSTOM SELECT OPTION FOR ADD ACCOUNT
document.addEventListener('DOMContentLoaded', function () {
    // Get the select element
    var userOfficeSelect = document.getElementById('userOfficeSelect');

    // Add an event listener for change events
    userOfficeSelect.addEventListener('change', function () {
        // Check if the selected option is "custom"
        if (userOfficeSelect.value === 'custom') {
            // Show SweetAlert popup with an input field
            Swal.fire({
                title: 'Enter New Office',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please enter a new Office';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var customOffice = result.value;

                    // Update the value and name of the "custom" option in the select
                    var customOption = document.getElementById('custom');
                    customOption.value = customOffice;
                    customOption.innerText = customOffice;

                    // Optionally, select the "custom" option
                    customOption.selected = true;

                    console.log('Custom Office:', customOffice);
                }
            });
        }
    });
});

