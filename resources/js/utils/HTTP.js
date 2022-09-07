import axios from 'axios';

export const HTTP = axios.create({
  baseURL: '/api/',
  timeout: 15000,
});