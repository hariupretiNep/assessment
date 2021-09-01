<template>
  <HomeLayout>
        <div class="max-w-md mt-20 bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="md:flex">
            <div class="p-12">
            <div class="tracking-wide text-sm text-gray-500 font-semibold">Published at: {{details.publishedAt}}</div>
            <div class="tracking-wide text-sm text-gray-500 font-semibold mb-10">Author: {{details.author}}</div>
            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{details.source.name}}</div>
            <span class="block mt-1 text-lg leading-tight font-medium text-black ">{{details.title}}</span>
            <p class="mt-2 text-gray-900">{{details.description}}</p>
            </div>
               <div class="md:flex-shrink-0">
                <img class="h-48 object-cover md:h-50 md:w-48" :src="details.urlToImage">
            </div>
        </div>
            <div v-if="$page.props.auth.user" class="grid grid-cols-3 gap-4 relative p-10">
                <div class="block rounded p-2 bg-auto border-solid border-2 border-light-blue-500">
                <button :disabled="isLiked" v-on:click="addLike()" class="text-gray-800 hover:text-blue-800 cursor-pointer">
                    Like
                </button><span v-if="totalLike>0" v-bind="totalLike" class="text-gray-400 float-right">({{totalLike}})</span>

                </div>
                <div class="block rounded p-2 bg-auto border-solid border-2 border-light-blue-500">
                <button :disabled="isDisliked"  v-on:click="addDislike()" class="text-gray-800 hover:text-blue-800 cursor-pointer">
                    Dislike 
                </button><span v-if="totalDislike>0" class="text-gray-400 float-right">({{totalDislike}})</span>
                </div>
                <div class="text-center pt-2 hover:text-blue-800">
                    <a :href="details.url" target="_blank">View Complete News</a>
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
    details: Object,
    totalLike: Number,
    totalDislike: Number,
    },
    data() {
        return {
            isLiked: false,
            isDisliked: false,
            totalLike: this.totalLike,
            totalDislike: this.totalDislike,
        }
    },
    setup() {
        return {
          
        }
    },
    methods:{
        addLike: function () {
            axios.post(this.route('Like'), {
                url:this.details.url
            })
            .then(function (response) {
                console.log("Liked");
            });
            this.isLiked = true;
            this.totalLike = this.totalLike+1;
        },

        addDislike: function () {
            axios.post(this.route('Dislike'), {
                url:this.details.url
            })
            .then(function (response) {
                console.log("Disliked");
            });
            this.isDisliked = true;
            this.totalDislike = this.totalDislike+1;
        },
    }
}
</script>
<style scoped>
.liked{
    background: blue;
}
</style>