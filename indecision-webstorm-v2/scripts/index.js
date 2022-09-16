import ComboStateStatelessAppComponent_V2 from "../src/comboStateStatelessAppComponent_V2";
import LocalStorageAppComponent from "../src/components/LocalStorageAppComponent";
import LocalStorageCounterComponent from "../src/counterComponents/LocalStorageCounterComponent";


ReactDOM.createRoot(document.getElementById('appCounter')).render(
    <React.StrictMode><LocalStorageCounterComponent/></React.StrictMode>);
ReactDOM.createRoot(document.getElementById('appV2')).render(
    <React.StrictMode><ComboStateStatelessAppComponent_V2/></React.StrictMode>);
ReactDOM.createRoot(document.getElementById('appLocalStorage')).render(
    <React.StrictMode><LocalStorageAppComponent/></React.StrictMode>);