const parentElement = document.querySelector(".movie_grid");
const loadMore = document.querySelector('.voir_plus');
let currentPage = 0;
let itemPerPage = 3;
let initialPerPage = 6;


//fetching the json php gives us
async function fetchData(currentPage, itemPerPage) {

    try{
        const response = await fetch(`api.php?page=${currentPage}&perPage=${itemPerPage}`);

        if(!response.ok) {
            throw new Error("Couldn't fetch resource");
        }

        const data = await response.json();
        let html = '';
        for (const item of data.news) {
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
        parentElement.innerHTML += html;
        const totalItems = data.total;
        const totalPages = (totalItems / itemPerPage);
        
        if(currentPage >= totalPages - 1){
            loadMore.style.display = 'none';
        }

        
    }
    catch(error){
        console.error(error);
    }
}

fetchData(currentPage, initialPerPage);
currentPage = Math.ceil(initialPerPage/itemPerPage -1);

loadMore.addEventListener('click', () => {
    currentPage ++;
    fetchData(currentPage, itemPerPage);
});
