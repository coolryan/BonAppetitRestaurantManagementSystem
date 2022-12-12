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
            tip: 0.0
        }
        this.updateOrder = this.updateOrder.bind(this);
        this.updateInStore = this.updateInStore.bind(this);
        this.updateTip = this.updateTip.bind(this);
        
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

    updateInStore(event) {
        const inStore = event.target.checked;
        this.setState({inStore: inStore});
    }

    updateTip(event) {
        const tip = event.target.value;
        this.setState({tip: tip});
    }

    updateOrder(menuItemId, instructionList) {
        console.log("Updating order");
        const itemPrice = this.state.priceLookup[menuItemId];
        const itemTotal = itemPrice * instructionList.length;
        let order = Object.assign({}, this.state.order);
        order[menuItemId] = instructionList;
        this.setState({order: order});
    }

    render() {
        let orderTotal = 0.0;
        for(const [menuItemId, instructionList] of Object.entries(this.state.order)) {
            orderTotal += this.state.priceLookup[menuItemId] * instructionList.length;
        }

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

        return (
            <div>
                <div id="orderTotal">Sub Total: ${orderTotal}</div>
                <label for="tip">Tip</label>
                <input id="tipInput" name="tip" type="number" min="0.00" step="0.01" value={this.state.tip} onChange={this.updateTip} />
                <label for="inStoreCheckbox">In Store</label>
                <input name="inStoreCheckbox" id="inStoreCheckbox" type="checkbox" checked={this.state.inStore} onChange={this.updateInStore} />
                <div id="menu">{categories}</div>
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
                    <button className="addOrderButton" onClick={this.addOrder.bind(this)}>Add to order</button>
                </div>
                <div className="menuItemPrice">{this.state.price}</div>
                <div className="menuItemDescription">{this.state.description}</div>
                {orderInstructionHtml}
            </div>
        );
    }

}

function Body() {
    return (
      <main>
        <div id="content">
          <h1>Order from our menu</h1>
          <p>Select your order.</p>
          <MenuList />
        </div>
      </main>
    );
}

// function MenuItem(menuItem) {
//     return (
//         <div className="menuItem">
//             <div className="menuItemName">menuItem.name</div>
//             <div className="menuItemPrice">menuItem.price</div>
//             <div className="menuItemDescription">menuItem.description</div>
//         </div>
//     );
// }

function App() {
    return (
      <div>
        <Body />
      </div>
    );
}
ReactDOM.render(<App />, document.getElementById('root'));