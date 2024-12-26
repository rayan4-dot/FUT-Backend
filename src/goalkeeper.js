
document.getElementById('addNationalityBtn').addEventListener('click', function () {
    document.getElementById('nationalityModal').style.display = 'block';
    document.getElementById('modalOverlay').style.display = 'block';
});

document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('nationalityModal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
});

document.getElementById('modalOverlay').addEventListener('click', function () {
    document.getElementById('nationalityModal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
});