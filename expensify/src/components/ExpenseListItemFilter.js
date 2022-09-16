import React from 'react';
import {connect} from "react-redux";
import {setTextFilter, sortDateFilter, sortAmountFilter} from "../actions/filtersActions";

const ExpenseListItemFilter = (props) => (
    <div>
        <div>
            <input type={"text"} value={props.filters.text} onChange={(event) => {
                props.dispatch(setTextFilter(event.target.value))
            }}/>
            <select
                value={props.filters.sortBy}
                onChange={(event) => {props.dispatch(event.target.value === 'amount' ? sortAmountFilter() : sortDateFilter())}}>
                <option value='amount'> Amount </option>
                <option value='date' > Date </option>
            </select>
        </div>
    </div>


);


export default connect((state) =>
    ({
        filters: state.reducerFilters
    })
)(ExpenseListItemFilter)