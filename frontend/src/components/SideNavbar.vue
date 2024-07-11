<template>
    <div>
        <nav class="sidebar" id="mySidebar" @mouseover="toggleSidebar" @mouseout="toggleSidebar">
            <div class="img">
                <img class="brand" src="@/assets/svg/logo-3C-Black.svg">
            </div>
            <a href="#"><i class="bi bi-telephone material-icons"></i><span class="icon-text">Discadora</span></a><br>
            <a href="#"><i class="bi bi-bar-chart-steps material-icons"></i><span class="icon-text">Dashboard</span></a><br>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'SideNavbar',
    data() {
        return {
            mini: true
        };
    },
    methods: {
        toggleSidebar() {
            const sidebar = document.getElementById("mySidebar");
            const main = document.getElementById("main");

            if (this.mini) {
                console.log("opening sidebar");
                sidebar.style.width = "250px";
                if (main) {
                    main.style.marginLeft = "250px";
                }
                this.mini = false;
            } else {
                console.log("closing sidebar");
                sidebar.style.width = "85px";
                if (main) {
                    main.style.marginLeft = "85px";
                }
                this.mini = true;
            }
        }
    }
}
</script>

<style>
.sidebar {
    height: 100%;
    width: 85px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    transition: 0.5s;
    overflow-x: hidden;
    white-space: nowrap;
}

.sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
}

.sidebar a:hover {
    color: #f1f1f1;
}

.material-icons,
.icon-text {
    vertical-align: middle;
}

.material-icons {
    padding-bottom: 3px;
    margin-right: 30px;
}

#main {
    padding: 16px;
    margin-left: 85px;
    transition: margin-left 0.5s;
}

.img{
    width: auto;
    background-color: #FFBD00;
}

.brand{
    padding: 20px 10px;
}
</style>
