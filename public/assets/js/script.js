(()=>{
    const toggle = document.getElementById('toggle');
const toggleStatus = document.getElementById('toggle-status');

toggle.addEventListener('change', () => {
    toggleStatus.textContent = toggle.checked ? 'Show' : 'Hidden';
});
toggleStatus.textContent = toggle.checked ? 'Show' : 'Hidden';
})