class MenuList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            menuItems: [],
            priceLookup: {},
            // Track the order, where the key is the menu item, and the value is the list of instructions
            order: {},
            orderId: null,
            inStore: true,
            tip: 0.0,
            tableId: null,
            serverId: null
        }
        this.updateOrder = this.updateOrder.bind(this);
        this.updateInStore = this.updateInStore.bind(this);
        this.updateTip = this.updateTip.bind(this);
        this.submitOrder = this.submitOrder.bind(this);
        this.updateTable = this.updateTable.bind(this);
        this.updateServer = this.updateServer.bind(this);
    };
    

    componentDidMount() {
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
    }

    submitOrder() {
        if(!this.state.order) {
            console.log("Empty order");
            return;
        }
        console.log("Submitting order");
        let orderItems = [];
        for(const [menuItemId, instructionList] of Object.entries(this.state.order)) {
            const menuItemOrderList = instructionList.map(orderInstruction => {
                return {"menu_item_id": menuItemId, "instructions":  orderInstruction};
            });
            orderItems.push(menuItemOrderList);
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
        fetch("/api/menuorder.php", requestOptions).then(
            response => response.json()
        ).then(jsonResult => {
            console.log("Got result from posting");
        });
    }

    updateInStore(event) {
        const inStore = event.target.checked;
        if(inStore) {

        }
        this.setState({inStore: inStore});
    }

    updateTip(event) {
        const tip = parseFloat(event.target.value);
        this.setState({tip: tip});
    }

    updateTable(event) {
        const tableId = parseInt(event.target.value);
        this.setState({tableId: tableId})
    }

    updateServer(event) {
        const serverId = parseInt(event.target.value);
        this.setState({serverId: serverId})
    }

    updateOrder(menuItemId, instructionList) {
        console.log("Updating order");
        const itemPrice = this.state.priceLookup[menuItemId];
        const itemTotal = itemPrice * instructionList.length;
        let order = Object.assign({}, this.state.order);
        order[menuItemId] = instructionList;
        this.setState({order: order});
    }

    getOrderSubTotal() {
        let orderTotal = 0.0;
        for(const [menuItemId, instructionList] of Object.entries(this.state.order)) {
            orderTotal += this.state.priceLookup[menuItemId] * instructionList.length;
        }
        return orderTotal;
    }

    getTax(orderTotal) {
        const tax = Math.round(.0875 * orderTotal * 100)/100;
        return tax;
    }

    getOrderTotal() {
        const orderTotal = this.getOrderSubTotal();
        const tax = this.getTax(orderTotal);
        const tip = this.state.tip;
        return orderTotal + tax + tip;
    }

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
                <div className="menucategory"><div className='categoryheading'><h4>{key}</h4></div>{menuItemHtml}</div>
            );
        });
        const tax = this.getTax(orderTotal);
        const grandTotal = this.getOrderTotal();
        let tableHtml = null;
        let serverHtml = null;
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

class MenuItem extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            menuItemId: this.props.menuItemId,
            name :this.props.name,
            price: this.props.price,
            description: this.props.description,
            orderInstructions: this.props.orderInstructions
        }
    }
    addOrder() {
        console.log("You clicked the button");
        let orderInstructions = [...this.state.orderInstructions];
        orderInstructions.push("");
        this.props.onChange(this.state.menuItemId, orderInstructions);
        this.setState({orderInstructions: orderInstructions});
    }

    updateInstruction(event) {
        console.log("Updating instruction");
        let orderInstructions = [...this.state.orderInstructions];
        const instructionId = event.target.id;
        const index = parseInt(event.target.id.split('_')[1]);
        orderInstructions[index] = event.target.value;
        this.props.onChange(this.state.menuItemId, orderInstructions);
        this.setState({orderInstructions: orderInstructions});
    }

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

function Body() {
    return (
      <main>
          <h1>Order from our menu</h1>
          <MenuList />
      </main>
    );
}


function App() {
    return (
      <div>
        <Body />
      </div>
    );
}
ReactDOM.render(<App />, document.getElementById('root'));
