import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs';
import { GenreService } from '../../service/genre-service';

@Component({
  selector: 'app-delete-genre',
  templateUrl: './delete-genre.component.html',
  styleUrls: ['./delete-genre.component.css']
})
export class DeleteGenreComponent {

  private routeSub: Subscription;
  id: number;
  msg: any;
  processing: boolean;

  constructor(private route: ActivatedRoute, private genreService:GenreService) { }  

  ngOnInit() {
    this.processing = true;
    this.routeSub = this.route.params.subscribe(params => {
       this.id = params['id']
    });

    this.genreService.deleteGenre(this.id).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.processing = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false;
        }
      }
    );
  }

  ngOnDestroy() {
    this.routeSub.unsubscribe();
  }
}
