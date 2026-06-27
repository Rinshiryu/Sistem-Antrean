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


/* ===============================
   STATUS ANTREAN LIVE
================================= */

async function loadStatusAntrean()
{
    try
    {
        const response = await fetch('/status-antrean');

        const result = await response.json();

        result.forEach(function(poli)
        {
            const current = document.getElementById('current-' + poli.kode);
            const next = document.getElementById('next-' + poli.kode);

            if(current)
            {
                current.textContent = poli.current;
            }

            if(next)
            {
                next.textContent = poli.next;
            }

        });

    }
    catch(error)
    {
        console.log(error);
    }
}


document.addEventListener('DOMContentLoaded', function()
{
    loadStatusAntrean();

    setInterval(loadStatusAntrean,3000);
});