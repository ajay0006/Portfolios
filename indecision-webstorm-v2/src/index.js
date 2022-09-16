import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import LocalStorageAppComponent from "./components/LocalStorageAppComponent";
import reportWebVitals from './reportWebVitals';
import App from "./App";


ReactDOM.createRoot(document.getElementById('app')).render(<React.StrictMode><App/></React.StrictMode>);
ReactDOM.createRoot(document.getElementById('appStateless')).render(
    <React.StrictMode><LocalStorageAppComponent/></React.StrictMode>);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
