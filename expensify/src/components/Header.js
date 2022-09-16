import React from "react";
import {NavLink} from "react-router-dom";

let activeStyle = {
    textDecoration: "underline",
    fontWeight: "bold",
};
const Header = () => (

    <header>
        <nav
            style={{
                borderBottom: "solid 1px",
                paddingBottom: "1rem",
            }}
        >
            <NavLink to="/" className="nav-link" style={({ isActive}) => isActive ? activeStyle : undefined}>Home</NavLink> | {" "}
            <NavLink to="expenseList" className="nav-link"  style={({ isActive}) => isActive ? activeStyle : undefined}>Expenses</NavLink> | {" "}
            <NavLink to="addExpense" className="nav-link"  style={({ isActive}) => isActive ? activeStyle : undefined}>Create</NavLink> | {" "}
            <NavLink to="helpExpense"
                     className={({ isActive }) =>
                         ["nav-link", isActive ? "active-Style" : null]
                             .filter(Boolean)
                             .join(" ")
                     }
            >
                Help
            </NavLink>
        </nav>
    </header>

);

export default Header;