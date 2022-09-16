import React from "react";
import 'normalize.css/normalize.css';
import '../styles/styles.scss';
import AppRouter from "../routers/AppRouter";

class ExpensifyApp extends React.Component{
    render() {
        return (
            <div>
                <AppRouter/>
            </div>
        )
    }
}
export default ExpensifyApp;