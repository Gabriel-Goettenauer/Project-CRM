<template>
    <div class="main-home">
        <SideNavbar :user="user" />
        <div>
            <div class="d-flex flex-column justify-content-center mx-3">
                <div class="">
                    <h1 class="px-5 py-3">Olá {{ user.name }} , Seja bem-vindo(a)!</h1>
                </div>
                <div>
                    <h4 class="px-5 pt-2 pb-5">O que vamos fazer hoje ?</h4>
                </div>
            </div>
            <div class="d-flex justify-content-center ">
                <div class="card text-center mx-3" style="width: 18rem;">
                    <i class="bi bi-telephone-outbound pt-4 pb-2"></i>
                    <div class="card-body">
                        <h2 class="card-title">Discador</h2>
                    </div>
                </div>
                <div class="card text-center mx-3" style="width: 18rem;">
                    <i class="bi bi-telephone-inbound pt-4 pb-2"></i>
                    <div class="card-body">
                        <h2 class="card-title">Receptivo</h2>
                    </div>
                </div>
                <div class="card text-center mx-3" style="width: 18rem;">
                    <i class="bi bi-chat-left pt-4 pb-2"></i>
                    <div class="card-body">
                        <h2 class="card-title">SMS</h2>
                    </div>
                </div>
                <div class="card text-center mx-3" style="width: 18rem;">
                    <i class="bi bi-globe pt-4 pb-2"></i>
                    <div class="card-body">
                        <h2 class="card-title">3C Voice</h2>
                    </div>
                </div>
                <div class="card text-center mx-3" style="width: 18rem;">
                    <i class="bi bi-bar-chart-steps pt-4 pb-2"></i>
                    <div class="card-body">
                        <h2 class="card-title">CRM</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import SideNavbar from "../components/SideNavbar.vue";
import { getUser } from '../services/ApiPrivateService';

export default {
    components: {
        SideNavbar,
    },
    data() {
        return {
            user: {},
        }
    },
    methods: {
        async getInfo() {
            try {
                const response = await getUser(this.getTokenableId);
                this.user = response.data;
            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        },
    },
    computed: {
        ...mapGetters(['getTokenableId']),
    },
    mounted() {
        this.getInfo();
    },
};
</script>


<style scoped>
.main-home {
    margin-left: 72px;
    height: 100vh;
    background-color: #F9FAFC;
}
h1{
    font-family: 'RandomGrotesqueStandardMedium';
    color: #1B1B2B;
}
h4{
    font-family: 'CerebriSansProRegular';
    color: #1B1B2B;
}
h2{
    font-family: 'CerebriSansProRegular';
}
.bi{
    font-size: 40px;
}
.card:hover{
    border: 1px solid #B1C2D9;
    cursor: pointer;
}
</style>
