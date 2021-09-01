<template>
  <HomeLayout>
    <div v-for="news in newsdata" :key="news.id" class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 grid grid-flow-col auto-cols-max">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="md:flex">
        <div class="md:flex-shrink-0">
        <img class="h-48 w-full object-cover md:h-full md:w-48" :src="news.urlToImage" :alt="news.title">
        </div>
        <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
            {{news.author}}
        </div>
        <a v-on:click="showDetails(news)" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{news.title}}</a>
        <p class="mt-2 text-gray-500">
            {{news.description}}
        </p>
        </div>
        </div>
        </div>
    </div>
  </HomeLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import HomeLayout from '../Layouts/HomeLayout.vue';

export default {
    components: {
      Head,
      HomeLayout,
    },
    props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    newsdata: Object,
    country: Object,
    lang: Object,
    sources: Object,
    },
    data() {
        return {
            form:"",
        }
    },
    setup() {
        return {
          
        }
    },
    methods:{
        showDetails: function (newsdata) {
            this.form = this.$inertia.form({details:newsdata});
            this.form.post(this.route('Details'), {
                onFinish: () => console.log("Data passed")
            });
        },
    }
}
</script>