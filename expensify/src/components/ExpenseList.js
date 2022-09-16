import React from "react";
import {connect} from "react-redux";
import ExpenseListItem from "./ExpenseListItem";
import ExpenseListItemFilter from "./ExpenseListItemFilter";
import {getVisibleExpenses} from "../selectors/expensesSelector";

const ExpenseList = (props) => (
    <div>
        <h1>Expense List</h1>
        <div>
            <ExpenseListItemFilter/>
        </div>
        {props.expenses.map((expense) => (
            <ExpenseListItem
                key={expense.id}
                {...expense}
            />
        ))
        }
    </div>
);

const mapStateToProps = (state) => {
    return {
        expenses: getVisibleExpenses(state.reducerExpenses, state.reducerFilters)
    }
}

export default connect(mapStateToProps)(ExpenseList)