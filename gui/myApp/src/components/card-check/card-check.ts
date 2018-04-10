import { Component, Input, Output, EventEmitter } from '@angular/core';

/**
 * Generated class for the CardCheckComponent component.
 *
 * See https://angular.io/api/core/Component for more info on Angular
 * Components.
 */
@Component({
  selector: 'card-check',
  templateUrl: 'card-check.html'
})
export class CardCheckComponent {
  _checkName: boolean;
  
  @Input('checkName')
  set checkName(checked: boolean) {
    this._checkName = checked;
    this.checkchange.emit(this._checkName);
  }
  get checkName() {
    return this._checkName;
  }
    
  @Input('title')
  title: string;

  @Output() checkchange :EventEmitter<any> = new EventEmitter();
  
  
  constructor() {
    console.log('Hello CardCheckComponent Component');
  }

  checkChange(value) {
    this._checkName = value;
    this.checkchange.emit(this._checkName);
  }

}
