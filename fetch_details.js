const detailsParentElement = document.querySelector('.details');

async function fetchDetails(id) {
    try{
        const response = await fetch(`/api/cinema/liste`);

        if(!response.ok) {
            throw new Error("Couldn't fetch resource");
        }

        const data = await response.json();
        let html = '';
        for (const item of data.news) {
            html = `
                    <div class='movie'>
                    <img class='movie_img' src='${item.img}' style='width: 30%; height: 50%;' alt='affiche du film'>
                    <h3 class='categories'>
                        <a href='${item.link}'>${item.title}</a>
                    </h3>
                    <p class='summary'>${item.description}</p>
                    </div>
                    `
                ;
            }
        detailsParentElement.innerHTML = html;
    }
    catch(error){
        console.error(error);
    }
}
