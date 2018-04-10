import { Component } from '@angular/core';
import { Input } from '@angular/core/src/metadata/directives';

/**
 * Generated class for the StdCardComponent component.
 *
 * See https://angular.io/api/core/Component for more info on Angular
 * Components.
 */
@Component({
  selector: 'std-card',
  templateUrl: 'std-card.html'
})
export class StdCardComponent {

  @Input('title') title: String = "";

  constructor() {
  }

}
