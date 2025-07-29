<script setup lang="ts">

</script>

<template>
    <div class="overflow-scroll border h-fit border-current rounded-2xl text-xs sm:text-base">
        <table class="text-nowrap w-full table-auto md:table-fixed *:*:!pr-4 *:border-b last:border-none even:*:bg-adminColor1 *:border-current
             dark:even:*:bg-adminColor4">
            <tr class="h-14">
                <td class="hidden md:table-cell w-[5%]">آیدی</td>
                <td>نام و نام خانوادگی</td>
                <td>نام کاربری</td>
                <td class="text-center">عملیات</td>
                <td class="w-[7%]">مقام</td>
                <td class="hidden md:table-cell w-[7%]">جنسیت</td>
                <td>شماره تماس</td>
                <td class="hidden md:table-cell">ایمیل</td>
            </tr>
            <slot/>
        </table>
    </div>
</template>
