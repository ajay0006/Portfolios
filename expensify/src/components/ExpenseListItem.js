import React from 'react';
import {NavLink} from "react-router-dom"; // this enables you to connect pages within the DOM

const ExpenseListItem = ({id, description, amount, dateCreated}) => (
    <div>
        <NavLink to={`/expenseList/${id}`}>
            {/* note you have to have set this up in your router, to point to the correct page in this case is the edit page
                and use a template string quotes, this enables you to quote the id variable*/}
            <h3>
                {description}
            </h3>
        </NavLink>
        <p>{amount} - {dateCreated}</p>
        <button>Edit</button>
    </div>
);


export default(ExpenseListItem)