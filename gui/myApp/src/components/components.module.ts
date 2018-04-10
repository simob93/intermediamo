import { NgModule } from '@angular/core';
import { StdCardComponent } from './std-card/std-card';
import { CardCheckComponent } from './card-check/card-check';
@NgModule({
	declarations: [StdCardComponent,
    CardCheckComponent],
	imports: [],
	exports: [StdCardComponent,
    CardCheckComponent]
})
export class ComponentsModule {}
