function openQueueModal(kode)
{
    document.getElementById('kode_poli').value = kode;

    document.getElementById('queueModal').style.display = 'flex';
}

function closeQueueModal()
{
    document.getElementById('queueModal').style.display = 'none';
}

window.addEventListener('click', function(event)
{
    const modal = document.getElementById('queueModal');

    if(event.target === modal)
    {
        closeQueueModal();
    }
});