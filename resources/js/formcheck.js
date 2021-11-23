const formCheck = {
    form: document.querySelector('#check'),
    child: document.querySelectorAll('#check input, #check textarea'),
    el: [],
    btn: document.querySelector("#check input[type=submit]"),

    init() {
        this.child.forEach((child, index) => {
            child.index = index
            if (child.type == 'hidden' || child.value) {
                this.el.push([child, true])
            } else {
                this.el.push([child, false])
            }
        })
        this.listener()
    },

    changeEl(child) {
        if (child.value === '') {
            this.el[child.index][1] = false
        } else {
            this.el[child.index][1] = true
        }
        this.check()
    },

    check() {
        this.allChecked = this.el.find(el => {
            return el[1] === false
        });

        this.btn.disabled = !!this.allChecked;
    },

    listener() {
        this.child.forEach(child => {
            child.addEventListener('keyup', () => {
                this.changeEl(child)
            })
        })
    }
}

if(formCheck.form) {
    formCheck.init();
}
