import {ref} from "vue";

const Products = ref([
    {
        name: "امامکتین",
        price: "200,000",
        count: "2",
        description: "این حشره کشه",
        picture: "product.png",
    },
    {
        name: "علیرضا",
        price: "100,000,000,000,000",
        count: "1",
        description: "آق مهندس علیرضا",
        picture: "product.png",
    },
    {
        name: "علف کش",
        price: "500,000",
        count: "1",
        description: "مناسب همه نوع علف",
        picture: "product.png",
    },
    {
        name: "Products",
        price: "100,000",
        count: "10",
        description: "Product description",
        picture: "product.png",
    },
    {
        name: "Products",
        price: "1,000",
        count: "100",
        description: "Product description",
        picture: "product.png",
    },
]);

const productCountIncrement = (index) => {
    Products.value[index].count++;
}
const productCountDecrement = (index) => {
    Products.value[index].count > 0 ? Products.value[index].count-- : Products.value[index].count;
}
export {
    Products,
    productCountIncrement,
    productCountDecrement,
}
