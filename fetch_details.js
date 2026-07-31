const detailsParentElement = document.querySelector('.details');
const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');

async function fetchDetails(id) {
    try{
        const response = await fetch(`/api/cinema/${id}`);

        if(!response.ok) {
            throw new Error("Couldn't fetch resource");
        }

        const data = await response.json();
        let html = `
                    <div class='movie'>
                    <img class='movie_img' src='${data.img}' style='width: 30%; height: 50%;' alt='affiche du film'>
                    <h3 class='categories'>
                        <a href='${data.link}'>${data.title}</a>
                    </h3>
                    <p class='summary'>${data.description}</p>
                    </div>
                    `
                ;
        detailsParentElement.innerHTML = html;
    }
    catch(error){
        console.error(error);
    }
}
