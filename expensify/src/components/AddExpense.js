import React from "react";
import {connect} from "react-redux";
import ExpenseForm from "./ExpenseForm";
import {addExpense} from "../actions/expensesAction";
import {useNavigate} from "react-router-dom";

const AddExpense = (props) => {
    let navigate = useNavigate();
    return ( // i need to use props here to get access to props, just like a normal function
        <div>
            <ExpenseForm
                onSubmit={(expense) => {
                    props.dispatch(addExpense(expense))
                    navigate("expenseList")
                }}/>
        </div>
    )
};

export default connect()(AddExpense); // allows me to have access to the props,which in this case include the reducers, which have the actions, this was done in the expenseList page