import axios from "axios";

const http = axios.create({
    baseURL: "http://localhost:8000/api/",
    headers: {
        "Content-type": "application/json",
    },
});


http.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    console.log(token);
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
    }, error => {
    return Promise.reject(error);
});

    export const getFunnels = async() =>{
        return await http.get('funnels')
    }
    export const postFunnels = async(funnel) =>{
        return await http.post('funnels')
    }
    export const deleteFunnel = async(id) =>{
        return await http.delete(`/funnels/${id}`)
    }
    export const postFunnel = async(funnel) =>{
        return await http.post('funnels',funnel)
    }
    export const getContacts = async() =>{
        return await http.get('contacts')
    }
    export const getTables = async() =>{
        return await http.get('stages')
    }


export default http;