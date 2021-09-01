<template>
  <div>
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="News" />
              <span class="text-white uppercase font-medium">News</span>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
            <div v-if="$page.props.canLogin" class="hidden top-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm text-white">
            Dashboard
            </Link>
            <template v-else>
            <Link :href="route('login')" class="text-sm text-white">
            Log in
            </Link>
            <Link :href="route('register')" class="ml-4 text-sm text-white">
            Register
            </Link>
            </template>
            </div>
            <Menu as="div" class="relative inline-block text-left">
              <div>
              <MenuButton class="inline-flex justify-center w-full rounded-md shadow-sm px-4 py-2 text-sm font-medium text-white hover:bg-blue">
              {{activeLang.length==0?"Language":activeLang}}
              <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
              </MenuButton>
              </div>
              <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none highzindex">
              <div class="py-1">
              <MenuItem v-for="eachlang in $page.props.lang" :key="eachlang">
              <a v-on:click="changeLang(eachlang)" :class="[activeLang == eachlang ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{eachlang}}</a>
              </MenuItem>
              </div>
              </MenuItems>
              </transition>
            </Menu>
            <Menu as="div" class="ml-3 relative" v-if="$page.props.auth.user">
              <div>
                <MenuButton class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                  <span class="sr-only">Open user menu</span>
                  <img class="h-8 w-8 rounded-full" :src="user.imageUrl" alt="" />
                </MenuButton>
              </div>
              <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                  <MenuItem>
                    <Link :href="route('logout')" method="post" as="button" class="p-2 highzindex" type="button">Logout</Link>
                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>
            </div>
          </div>
          <div class="mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <DisclosureButton class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
              <span class="sr-only">Open main menu</span>
              <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
              <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
            </DisclosureButton>
          </div>
        </div>
      </div>
      <DisclosurePanel class="md:hidden">
        <div class="pt-4 pb-3 border-t border-gray-700">
          <div v-if="$page.props.auth.user" class="flex items-center px-5">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
            </div>
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white">{{ $page.props.auth.user.name }}</div>
              <div class="text-sm font-medium leading-none text-gray-400">{{ $page.props.auth.user.email }}</div>
            </div>
          </div>
          <div v-if="$page.props.canLogin" class="top-0 px-6 py-4 ">
            <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm text-white">
            Dashboard
            </Link>
            <template v-else>
            <Link :href="route('login')" class="text-sm text-white">
            Log in
            </Link>
            <Link :href="route('register')" class="ml-4 text-sm text-white">
            Register
            </Link>
            </template>
          </div>
          <Menu as="div" class="relative inline-block text-right">
            <div>
            <MenuButton class="inline-flex justify-center w-full rounded-md shadow-sm px-4 py-2 text-sm font-medium text-white hover:bg-blue">
            {{activeLang.length==0?"Language":activeLang}}
            <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
            </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none highzindex">
            <div class="py-1">
            <MenuItem v-for="eachlang in $page.props.lang" :key="eachlang">
            <a v-on:click="changeLang(eachlang)" :class="[activeLang == eachlang ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{eachlang}}</a>
            </MenuItem>
            </div>
            </MenuItems>
            </transition>
            </Menu>
        </div>
      </DisclosurePanel>
    </Disclosure>
    <header class="bg-white shadow pt-3" style="height:60px;">
        <div class="max-w-7xl mx-auto  grid grid-flow-row grid-cols-2 grid-rows-3 gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">
          TOP Headlines
        </h1>
        </div>
        <div>
            <Menu as="div" class="relative inline-block text-left float-right">
            <div>
            <MenuButton class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
            {{activeCountry.length==0?"Country":activeCountry}}
            <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
            </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1">
            <MenuItem v-for="eachCountry in $page.props.country" :key="eachCountry.id" >
            <a v-on:click="changeCountry(eachCountry)" :class="[activeCountry == eachCountry ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{eachCountry}}</a>
            </MenuItem>
            <form method="POST" action="#">
            <MenuItem v-slot="{ active }">
            <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full text-left px-4 py-2 text-sm']">
            Sign out
            </button>
            </MenuItem>
            </form>
            </div>
            </MenuItems>
            </transition>
            </Menu>
        </div>
        </div>
    </header>
    <main>
<div class="max-w-7xl mx-auto grid grid-cols-6 gap-4">
    <div class="col-start-1 col-end-2">
    <p class="text-gray-500 font-large mt-10 text-center">
        News Category <a href="#" v-if="activeSource !=''" v-on:click="sourceChange('')" class="no-underline hover:underline text-blue-900"> All</a>
    </p>
    <ul class="list-none md:list-disc customlist">
        <li v-for="source in $page.props.sources" :class="activeSource == source ? 'active':''" v-on:click="sourceChange(source)" :key="source">{{source.charAt(0).toUpperCase() + source.substring(1)}}</li>
    </ul>
  </div>
  <div class="col-start-3 col-span-6">
    <slot />
  </div>
</div>
</main>
</div>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Head, Link, usePage } from '@inertiajs/inertia-vue3';
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'
import { ChevronDownIcon } from '@heroicons/vue/solid';


const user = {
  imageUrl:
    'https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png',
}

export default {
  name: 'HomeLayout',
    components: {
      Head,
      Link,
      Disclosure,
      DisclosureButton,
      DisclosurePanel,
      Menu,
      MenuButton,
      MenuItem,
      MenuItems,
      BellIcon,
      MenuIcon,
      XIcon,
      ChevronDownIcon
    },
    data() {
        return {
            activeSource:"",
            activeCountry:"",
            activeLang:"",
            form: this.$inertia.form({
                lang: '',
                country: '',
                source: ''
            }),
        }
    },
    setup() {
        return {
            user
        }
    },
    methods: {
    sourceChange: function (source) {
        this.activeSource = source;
        this.form.source = source;
        this.requestForChange();
    },
    changeCountry: function (country) {
        this.activeCountry = country;
        this.form.country = country;
        this.requestForChange();
    },
    changeLang: function (lang) {
        this.activeLang = lang;
        this.form.lang = lang;
        this.requestForChange();
    },
    requestForChange() {
        this.allArticle = "";
        this.form.post(this.route('Filternews'), {
          onFinish: () => console.log("complete")
        });
    }
    }
}
</script>
<style scoped>
.highzindex{
    z-index: 9999999999;
}
.customlist li{
    list-style: none;
    height:40px;
    cursor: pointer;
    border-bottom: 1px solid #a1a1a1;
    transition: all 0.5s;
    padding-top: 10px;
}
.customlist li:hover{
    margin-left: 4px;
    transition: all 0.5s;
}
.customlist .active{
    color:#148758;
    font-weight: bold;
    padding-right: 4px;
}
</style>