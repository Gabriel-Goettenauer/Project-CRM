import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    "Content-type": "application/json",
  },
});


export const postUser = async(user) =>{
  return await HttpService.post('register',user)
}
export const postLogin = async(user) =>{
  return await HttpService.post('login',user)
}

export default HttpService;
