
async function getItem(){
	let data = await fetch("https://www.themealdb.com/api/json/v1/1/search.php?s=");
	let item = await data.json();
	let foodItem = item.meals;
	return foodItem;
}

async function main() {
	const food = await getItem()
	const parent = document.querySelector('.insert--item');


	if(food){
		parent.innerHTML = food.map((item, index)=>{
			return `
				<div class="col-md-6 col-lg-4">
				<div class="card">
					<div class="img--box">
						<img src="${item.strMealThumb}" alt="a food image">
					</div>
				<div class="text--field">
					<h5 class="food--name dancing--script">${item.strMeal}</h5>
					<p class="price--tag">&#8377; ${(80 + index)*3}
					<del class="text-white-50">${((80 + index)*3)-20}</del>
					</p>
					<a href="/item/addtocart" class="px-5 py-2">Order Now</a>
				</div>
				</div>
			</div>

			`
		}).join(" ");
	}

}


 main();
