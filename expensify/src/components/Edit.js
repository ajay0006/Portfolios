import { compose} from "redux";
import {connect} from "react-redux";
import customWithRouter from "./customWithRouter";
import {useParams, useNavigate, useLocation} from "react-router-dom";
import ExpenseForm from "./ExpenseForm";
import {editExpense, removeExpense} from "../actions/expensesAction";
import React from "react";


// side note, i could have used props and used the props.expense.id to match against the expenses in the state, but that wod have been redundant, since
// React has a feature called useParams that enables me to get the id, since the purpose of utilising the props in this case was to get just the id
const Edit = (props) => {
    let id  = useParams().id;
    let navigate = useNavigate();
    let location = useLocation();

    return (
        <div>
            <ExpenseForm
                expense={props.expense}
                onSubmit={(expense) => {
                    props.dispatch(editExpense(id, expense))
                    navigate("/expenseList" + location.search)
                }}/>
            {/*            or you could use
            | you are editing expense {props.match.params.id}
            but you have to remove outlet from the EditExpense page*/}

            <button
                onClick= { () => {
                    props.dispatch(removeExpense({id}))
                    navigate("/expenseList")
                }}> Remove
            </button>
        < /div>
    );
};

//
const mapStateToProps = (state, { params: { id } = {} }) => {
    return ({
        expense: state.reducerExpenses.find((expense) => expense.id === id)
    })
}
export default compose( customWithRouter, connect(mapStateToProps))(Edit);

// export default connect((state, props) => {
//         console.log(props, "what is in here ");
//         const params = useParams().id;
//         console.log(params, 'what does my params look like')
//         return (
//             {
//                 expense: state.reducerExpenses.find((expense) => expense.id === params)
//             })
//     }
// )(Edit);