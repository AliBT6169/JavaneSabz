import {ref} from "vue";

const deliveryAmountHelper = async (weight, city_id, delivery_amount) => {
    return await axios.get(route('admin.deliveries.GetCityName', {city_id: city_id})).then((res) => {
        const city = res.data.city;
        const province = res.data.city;
        const province_percentage = ref(0);
        const bigCitiesPercentage = ref(0);
        switch (province) {
            case 'مازندران':
                province_percentage.value = 0;
                break;
            case 'گلستان' :
            case 'سمنان':
            case 'تهران' :
            case 'البرز' :
            case 'قزوین' :
            case 'گیلان':
                province_percentage.value = 40;
                break;
            default:
                province_percentage.value = 60;
                break;
        }
        switch (city) {
            case 'تهران':
            case 'مشهد':
            case 'کرج':
            case 'یزد':
            case 'اصفهان':
            case 'شیراز':
                bigCitiesPercentage.value = 15;
        }
        const deliveryAmount = ref(delivery_amount);
        deliveryAmount.value += deliveryAmount.value * province_percentage.value / 100;
        deliveryAmount.value += deliveryAmount.value * bigCitiesPercentage.value / 100;
        return deliveryAmount.value;
    }).catch((err) => {

    });
}
export {deliveryAmountHelper};
