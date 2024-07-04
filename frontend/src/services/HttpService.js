import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8000/",
  headers: {
    "Content-type": "application/json",
  },
});
// export const getMostPopular = async () => {
//   return await HttpService.get('top/anime?limit=5&filter=bypopularity')
export const postUser = async(user) =>{
  return await HttpService.post('/logins/create',user)
}
export default HttpService;
