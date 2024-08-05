<template>
  <div>
    <nav class="sidebar" id="mySidebar" @mouseover="toggleSidebar" @mouseout="toggleSidebar">
      <div class="img d-flex justify-content-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="50" viewBox="0 0 72 40" fill="none">
          <g id="Group 48095429">
            <g id="Group">
              <path id="Vector" d="M71.1111 17.765H66.5251V13.0171H62.2308V17.765H57.6481V22.2175H62.2308V26.9654H66.5251V22.2175H71.1111V17.765Z" fill="#373753"></path>
              <path id="Vector_2" d="M17.1338 13.2062L26.3191 0H4.41359V4.58645H17.6577L9.08252 17.109H13.002C17.8732 17.109 21.8358 21.2145 21.8358 26.2613C21.8358 31.3081 17.8732 35.4136 13.002 35.4136C8.73102 35.4136 5.15638 32.2563 4.34396 28.0752L0 28.9547C1.21034 35.2452 6.58225 40 13.002 40C20.3138 40 26.2627 33.8366 26.2627 26.2613C26.2627 20.1804 22.4294 15.0099 17.1338 13.2062Z" fill="#373753"></path>
              <path id="Vector_3" d="M57.6052 31.4456C54.9756 33.8883 51.5038 35.3793 47.7003 35.3793C39.5131 35.3793 32.848 28.4773 32.848 19.9916C32.848 11.5058 39.5098 4.60376 47.7003 4.60376C51.4905 4.60376 54.9524 6.08448 57.5787 8.51341L60.5034 5.06069C56.9718 1.8038 52.4687 0.020752 47.7003 0.020752C42.5506 0.020752 37.7092 2.09925 34.0683 5.87148C30.4273 9.64027 28.4244 14.6562 28.4244 19.9916C28.4244 23.3 29.1971 26.4882 30.6528 29.3293L28.7395 35.7676L35.3681 35.345C38.8234 38.3373 43.1408 39.9658 47.7003 39.9658C52.4621 39.9658 56.9619 38.1896 60.4901 34.9396L57.6052 31.4456Z" fill="#373753"></path>
            </g>
          </g>
        </svg>
      </div>
      <router-link :class="{'active-link': isActive('/')}" class="mt-2" to="">
        <i class="bi bi-telephone-outbound material-icons"></i>
        <span class="icon-text">Discadora</span>
      </router-link>
      <router-link :class="{'active-link': isActive('/')}" class="mt-2" to="">
        <i class="bi bi-telephone-inbound material-icons"></i>
        <span class="icon-text">Receptivo</span>
      </router-link>
      <router-link :class="{'active-link': isActive('/')}" to="">
        <i class="bi bi-chat-left material-icons"></i>
        <span class="icon-text">SMS</span>
      </router-link>
      <router-link :class="{'active-link': isActive('/')}" to="">
        <i class="bi bi-globe material-icons"></i>
        <span class="icon-text">3C Voice</span>
      </router-link>
      <router-link :class="{'active-link': isActive(`/dashboard/${tokenableID}`)}" :to="`/dashboard/${tokenableID}`">
        <i class="bi bi-bar-chart-steps material-icons"></i>
        <span class="icon-text">CRM</span>
      </router-link>
      <div class="bottom-link">
        <router-link :class="{'active-link': isActive('/')}" to="">
          <i class="bi bi-clipboard-data material-icons"></i>
          <span class="icon-text">Relatórios</span>
        </router-link>
        <router-link :class="{'active-link': isActive('/')}" to="">
          <i class="bi bi-gear-wide material-icons"></i>
          <span class="icon-text">Configurações</span>
        </router-link>
        <router-link :class="{'active-link': isActive('/')}" to="" data-bs-toggle="dropdown">
          <i class="bi bi-person-fill material-icons"></i>
          <span class="icon-text">{{ user.name }}</span>
        </router-link>
        <router-link :class="{'active-link': isActive('/')}" to="" data-bs-toggle="dropdown">
          <i class="bi bi-box-arrow-left material-icons"></i>
          <span class="icon-text">Sair</span>
        </router-link>
      </div> 
    </nav>
  </div>
</template>

<script>
import {getUser} from "@/services/ApiPrivateService.js";

export default {
  name: 'SideNavbar',
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      user:{},
      mini: true,
      tokenableID: localStorage.getItem('tokenableID')
    };
  },
  methods: {
    toggleSidebar() {
      const sidebar = document.getElementById("mySidebar");
      const main = document.getElementById("main");

      if (this.mini) {
        sidebar.style.width = "250px";
        if (main) {
          main.style.marginLeft = "250px";
        }
        this.mini = false;
      } else {
        sidebar.style.width = "72px";
        if (main) {
          main.style.marginLeft = "72px";
        }
        this.mini = true;
      }
    },
    isActive(route) {
      return this.$route.path === route;
    },
    async getInfo() {
      try {
        const response = await getUser(this.getTokenableId);
        this.user = response.data;
      } catch (error) {
        console.error('Error fetching user data:', error);
      }
    },
  },
};
</script>

<style>
.sidebar {
  display: flex;
  flex-direction: column;
  height: 100%;
  width: 72px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #FFFFFF;
  transition: 0.5s;
  overflow-x: hidden;
  white-space: nowrap;
  border-right: 1px solid #E1E9F4;
}

.sidebar a {
  padding: 8px 8px 8px 25px;
  text-decoration: none;
  font-size: 25px;
  color: #677C92;
  display: block;
}

.sidebar a:hover,
.sidebar .active-link {
  margin-left: 5px;
  color: #373753;
  border-left: solid 6px #FFBD00;
  border-radius: 5px;
  transition: 0.5s;
}

.material-icons,
.icon-text {
  vertical-align: middle;
  font-size: 22px;
}

.material-icons {
  padding-bottom: 3px;
  margin-right: 30px;
}

span {
  font-family: 'CerebriSansProRegular';
}

#main {
  padding: 16px;
  margin-left: 85px;
  transition: margin-left 0.5s;
}

.img {
  width: auto;
  background-color: #FFBD00;
  padding: 10px 10px;
}

.bottom-link {
  margin-top: auto;
}

.bi-box-arrow-left{
  color: #FF4444;
}
</style>

