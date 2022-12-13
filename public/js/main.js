// This script provides a ReactJS menu ordering component
class MenuList extends React.Component {
    // This is the table that shows the menu items and the order details
    constructor(props) {
        super(props);
        // Set up state to be tracked for the component
        this.state = {
            menuItems: [],
            priceLookup: {},
            // Track the order, where the key is the menu item, and the value is the list of instructions
            order: {},
            orderId: null,
            inStore: true,
            tip: 0.0,
            tableId: null,
            serverId: null,
            user: null,
            submitted: false
        }
        // Wire up methods so they have context when called
        this.updateOrder = this.updateOrder.bind(this);
        this.updateInStore = this.updateInStore.bind(this);
        this.updateTip = this.updateTip.bind(this);
        this.submitOrder = this.submitOrder.bind(this);
        this.updateTable = this.updateTable.bind(this);
        this.updateServer = this.updateServer.bind(this);
    };
    
    // This method will pull data in once only when the page loads
    componentDidMount() {
        // Fetch the menu
        fetch("/api/menu.php").then((response) => {
            // Login was successful
            if (response.ok) {
                return response.json();
            }
        }).then(data => {
            console.log("Got data");
            let priceLookup = {};
            data.forEach(menuItem => {
                priceLookup[menuItem.id] = menuItem.price;
            });
            this.setState({priceLookup: priceLookup});
            this.setState({ menuItems: data });
        });

        // Fetch some user information
        fetch("/api/info.php").then((response) => {
            // Login was successful
            if (response.ok) {
                return response.json();
            }
        }).then(data => {
            if(!["Anonymous","Unknown",""].includes(data["user"])) {
                this.setState({"inStore": true, "serverId": data["userId"]});
            } else {
                this.setState({"inStore": false});
            }
            this.setState({user: data["user"]});
        });
    }

    // Create the order in the BE
    submitOrder() {
        if(!this.state.order) {
            return;
        }
        // Arrange the order as expected by the BE API
        let orderItems = [];
        for(const [menuItemId, instructionList] of Object.entries(this.state.order)) {
            const menuItemOrderList = instructionList.map(orderInstruction => {
                return {"menu_item_id": menuItemId, "instructions":  orderInstruction};
            });
            orderItems = orderItems.concat(menuItemOrderList);
        }
        
        let data = {
            "tip": this.state.tip,
            "items": orderItems,
            "in_store": this.state.inStore
        }
        if(this.state.inStore) {
            data["restaurant_table_id"] = this.state.tableId;
            data["server_id"] = this.state.serverId;
        }
        const requestOptions = {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(data)
        };
        // Submit the order and update the state
        fetch("/api/menuorder.php", requestOptions).then(
            response => response.json()
        ).then(jsonResult => {
            this.setState({"submitted": true});
            this.setState({"orderId": jsonResult["orderId"]});
        });
    }

    // Handler to update the in_store state variable
    updateInStore(event) {
        const inStore = event.target.checked;
        if(inStore) {

        }
        this.setState({inStore: inStore});
    }

    // Handler to update the tip state variable
    updateTip(event) {
        const tip = parseFloat(event.target.value);
        this.setState({tip: tip});
    }

    // Handler to update the restaurant table state variable
    updateTable(event) {
        const tableId = parseInt(event.target.value);
        this.setState({tableId: tableId})
    }

    // Handler to update the server state variable
    updateServer(event) {
        const serverId = parseInt(event.target.value);
        this.setState({serverId: serverId})
    }

    // Handler to update the order with all its items
    updateOrder(menuItemId, instructionList) {
        console.log("Updating order");
        const itemPrice = this.state.priceLookup[menuItemId];
        const itemTotal = itemPrice * instructionList.length;
        let order = Object.assign({}, this.state.order);
        order[menuItemId] = instructionList;
        this.setState({order: order});
    }

    // Get the order subtototal
    getOrderSubTotal() {
        let orderTotal = 0.0;
        for(const [menuItemId, instructionList] of Object.entries(this.state.order)) {
            orderTotal += this.state.priceLookup[menuItemId] * instructionList.length;
        }
        return orderTotal;
    }

    // Get the order tax
    getTax(orderTotal) {
        const tax = Math.round(.0875 * orderTotal * 100)/100;
        return tax;
    }

    // Get the total for the order, including tax and tip
    getOrderTotal() {
        const orderTotal = this.getOrderSubTotal();
        const tax = this.getTax(orderTotal);
        const tip = this.state.tip;
        return orderTotal + tax + tip;
    }

    // Display the menu item
    render() {
        let orderTotal = this.getOrderSubTotal();

        let menuByCat = {};
        this.state.menuItems.forEach(menuItem => {
            if(!(menuItem.category in menuByCat)) {
                menuByCat[menuItem.category] = [];
            }
            menuByCat[menuItem.category].push(menuItem);
        });

        var categories = [];
        Object.keys(menuByCat).forEach((key, index) => {
            let menuItems = menuByCat[key];
            var menuItemHtml = menuItems.map((menuItem) => {
                return <MenuItem
                            onChange={this.updateOrder}
                            menuItemId={menuItem.id}
                            name={menuItem.name}
                            price={menuItem.price}
                            description={menuItem.description}
                            orderInstructions={[]}
                        />;
            });
            categories.push (
                <div className="menucategory"><div className="categoryheading"><h4>{key}</h4></div>{menuItemHtml}</div>
            );
        });
        const tax = this.getTax(orderTotal);
        const grandTotal = this.getOrderTotal();
        let tableHtml = null;
        let serverHtml = null;

        // If in store, show the table and server inputs
        if(this.state.inStore) {
            tableHtml = (
                <div className="orderInfo">
                    <label for="tableId">Table Id:</label>
                    <input id="tableId" name="tableId" type="number" min="1" step="1" value={this.state.tableId} onChange={this.updateTable} />
                </div>
            );
            serverHtml = (
                <div className="orderInfo">
                    <label for="serverId">Server Id:</label>
                    <input id="serverId" name="serverId" type="number" min="1" step="1" value={this.state.serverId} onChange={this.updateServer} />
                </div>
            );
        }

        return (
            <div>
                {this.state.submitted &&
                    <p id="successDiv" className="orderInfo">
                        Your order was successfully submitted
                    </p>
                }
                {this.state.orderId && 
                    <div className="orderInfo">
                        Order: {this.state.orderId}
                    </div>
                }
                <div id="orderTotalInfo">
                    <div id="orderTotal" className="orderInfo">Sub Total: ${orderTotal}</div>
                    <div id="taxTotal" className="orderInfo">Tax: ${tax}</div>
                    <div className="orderInfo">
                        <label for="tip">Tip:</label>
                        <input id="tipInput" name="tip" type="number" min="0.00" step="0.01" value={this.state.tip} onChange={this.updateTip} />
                    </div>
                    <div id="grandTotal" className="orderInfo">Grand Total: ${grandTotal}</div>
                    <div className="orderInfo">
                        <label for="inStoreCheckbox" >In Store</label>
                        <input name="inStoreCheckbox" id="inStoreCheckbox" type="checkbox" checked={this.state.inStore} onChange={this.updateInStore} />
                    </div>
                    {tableHtml}
                    {serverHtml}
                    <div className="orderInfo">
                        <div id="submitOrder" onClick={this.submitOrder}>Submit Order</div>
                    </div>
                </div>
                <div id="menu" class="orderMenu" >{categories}</div>
            </div>
        );
    }
}

// This class shows a single menu item
class MenuItem extends React.Component {
    constructor(props) {
        super(props);
        // Set the state for the component
        this.state = {
            menuItemId: this.props.menuItemId,
            name :this.props.name,
            price: this.props.price,
            description: this.props.description,
            orderInstructions: this.props.orderInstructions
        }
    }
    // Call the parent menulist to add this menu item to the order list
    addOrder() {
        let orderInstructions = [...this.state.orderInstructions];
        orderInstructions.push("");
        this.props.onChange(this.state.menuItemId, orderInstructions);
        this.setState({orderInstructions: orderInstructions});
    }

    // Update the instructions for the menu item state
    updateInstruction(event) {
        console.log("Updating instruction");
        let orderInstructions = [...this.state.orderInstructions];
        const instructionId = event.target.id;
        const index = parseInt(event.target.id.split('_')[1]);
        orderInstructions[index] = event.target.value;
        this.props.onChange(this.state.menuItemId, orderInstructions);
        this.setState({orderInstructions: orderInstructions});
    }

    // Display the menu item
    render () {
        var orderInstructionHtml = this.state.orderInstructions.map((instruction, index) => {
            const inputId = "instruction_" + index;
            return (
                <div>
                    <label for={inputId}>Order #{index+1}</label>
                    <input id={inputId} name={inputId} type="text" value={instruction} onChange={this.updateInstruction.bind(this)} placeholder="Enter special instructions"/>
                </div>
            );
        });
        return (
            <div className="menuItem">
                <div className = "itemNameAndOrderButton">
                    <div className="menuItemName">{this.state.name}</div>
                </div>
                <div className="menuItemPrice">{this.state.price}</div>
                <div className="menuItemDescription">{this.state.description}</div>
                <button className="addOrderButton" onClick={this.addOrder.bind(this)}>Add to order</button>
                {orderInstructionHtml}
            </div>
        );
    }

}

// This just encapsulates the order menu list
function Body() {
    return (
      <main>
          <h1>Order from our menu</h1>
          <MenuList />
      </main>
    );
}

// This is the parent component for the menu list
function App() {
    return (
      <div>
        <Body />
      </div>
    );
}
// Add the rendered javascript to the root element
ReactDOM.render(<App />, document.getElementById('root'));
