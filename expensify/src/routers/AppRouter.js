import React from "react";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import ExpensifyDashboard from "../components/ExpensifyDashboard";
import Header from "../components/Header";
import ExpenseList from "../components/ExpenseList";
import AddExpense from "../components/AddExpense";
import Edit from "../components/Edit";
import HelpExpense from "../components/Help";
import NotFoundPage from "../components/NotFound";
import Footer from "../components/Footer";

const AppRouter = () => (
    <BrowserRouter>
        <div>
            <Header/>
            <Routes>
                <Route path="/" element={<ExpensifyDashboard/>}/>
                <Route path="expenseList" element={<ExpenseList/>}/>
                <Route path="expenseList/:id" element={<Edit/>}> </Route>
                <Route path="addExpense"  element={<AddExpense/>}/>
                <Route path="helpExpense" element={<HelpExpense/>}/>
                <Route path='*' element={<NotFoundPage replace/>}/>
                <Route/>
            </Routes>
            <Footer/>
        </div>
    </BrowserRouter>
);

export default AppRouter;