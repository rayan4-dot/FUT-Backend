
document.getElementById('addPlayerBtn').addEventListener('click', function () {
    document.getElementById('playerModal').style.display = 'block';
    document.getElementById('modalOverlay').style.display = 'block';
});

document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('playerModal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
});

document.getElementById('modalOverlay').addEventListener('click', function () {
    document.getElementById('playerModal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
});


