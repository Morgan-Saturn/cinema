const parentElement = document.querySelector(".movie_grid");
const loadMore = document.querySelector('.voir_plus');
/*let page = 3;
const resultsPerPage = 3;
const skip = page - 1 * resultsPerPage;
const allNewsUrl = 'http://localhost/cinema/index.html?'
const paginatedUrl = `http://localhost/cinema/index.html?limit=${resultsPerPage}&skip=${skip}`;*/

//fetching the json php gives us
async function fetchData() {

    try{
        const response = await fetch('api.php');

        if(!response.ok) {
            throw new Error("Couldn't fetch resource");
        }

        const data = await response.json();
        let html = '';
        for (const item of data) {
            html += `
                <div class='movie'>
                    <img class='movie_img' src='${item.img}' style='width: 100%; height: 100%;' alt='affiche du film'>
                    <h3 class='categories'>
                        <a href='${item.link}'>${item.title}</a>
                    </h3>
                    <p class='summary'>${item.description}</p>
                </div>
                `;
        }
        parentElement.innerHTML = html;
        pagination(data);
        
    }
    catch(error){
        console.error(error);
    }
}

fetchData();

//création de la fonction qui s'occupera de la pagination
function pagination(data) {
    const allNews = data.length;
    const resultsPerPage = 3;

    //ceil car cette division peut avoir un reste
    const totalOfPages = Math.ceil(allNews / resultsPerPage);

    // je m'assure qu'on ne puisse pas avoir un nombre de pages plus grand que ce qui existe déjà au maximum
    let currentPage = 1;
    if (currentPage > totalOfPages) {
        currentPage = totalOfPages;
    }

    const slicing = Array.from({length: totalOfPages}, (_, index) => {
        const start = index * resultsPerPage;
        return data.slice(start, start + resultsPerPage);
    });

    console.log(slicing);
}


