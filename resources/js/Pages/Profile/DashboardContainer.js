import {ref} from "vue";

const Products = ref([
    {
        name: "امامکتین امامکتینامامکتینامامکتینامامکتین",
        price: 200000,
        count: 1,
        description: "این حشره کشه",
        picture: "/images/products/Emamectin.jpg",
    },
    {
        name: "علیرضا",
        price: 100000,
        count: 1,
        description: "آق مهندس علیرضا هستم نویسنده این پروژهآق مهندس علیرضا هستم نویسنده این پروژه",
        picture: "images/products/10640410.webp",
    },
    {
        name: "علف کش",
        price: 500000,
        count: 1,
        description: "مناسب همه نوع علف",
        picture: "/images/products/Emamectin.jpg",
    },
    {
        name: "Products",
        price: 100000,
        count: 10,
        description: "علف کش",
        picture: "/images/products/Emamectin.jpg",
    },
    {
        name: "Products",
        price: 1000,
        count: 100,
        description: "علف کش",
        picture: "images/products/10640410.webp",
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
