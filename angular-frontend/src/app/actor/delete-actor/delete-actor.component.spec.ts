import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DeleteActorComponent } from './delete-actor.component';

describe('DeleteActorComponent', () => {
  let component: DeleteActorComponent;
  let fixture: ComponentFixture<DeleteActorComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DeleteActorComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DeleteActorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
